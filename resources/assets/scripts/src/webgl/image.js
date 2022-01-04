import { gsap } from 'gsap';
import glsl from 'glslify';

import {
  LinearFilter,
  Mesh,
  PlaneBufferGeometry,
  ShaderMaterial,
  Vector2,
} from 'three';

import fragment from '../../../shaders/image.frag';
import vertex from '../../../shaders/image.vert';

import Object3D from '../utils/object3D';

class Image extends Object3D {
  init({ camera, scene, loader }, element, index, scroll = false) {
    super.init(camera, element);

    this.loader = loader;
    this.scroll = scroll;

    this.geometry = new PlaneBufferGeometry(1, 1, 64, 64);
    this.material = new ShaderMaterial({
      depthTest: false,
      depthWrite: false,
      transparent: true,
      fragmentShader: glsl(fragment),
      vertexShader: glsl(vertex),
    });

    this.material.uniforms = {
      uTexture: { value: 0 },
      uTime: { value: 0 },
      uWave: { value: 0 },
      uIndex: { value: index },
      uOffset: {
        value: new Vector2(0.0, 0.0),
      },
      uAlpha: {
        value: 0,
      },
    };

    this.texture = this.loader.load(element.src, (texture) => {
      texture.minFilter = LinearFilter;
      texture.generateMipmaps = false;

      this.material.uniforms.uTexture.value = texture;

      this.mesh = new Mesh(this.geometry, this.material);
      this.mesh.material.depthTest = false;
      this.mesh.renderOrder = 1000;

      this.add(this.mesh);
      scene.add(this);
    });

    element.style.opacity = 0;
    this.position.y = -10;

    this.bindMethods();
  }

  updateTime(time) {
    this.material.uniforms.uTime.value = time;

    if (this.scroll.diff !== 0)
      this.material.uniforms.uWave.value = (3 * this.scroll.diff) / 80;
  }

  bindMethods() {
    ['mouseEnter', 'mouseLeave'].forEach((fn) => {
      const bindedMethod = (this[fn] = this[fn].bind(this));

      this.element.addEventListener(fn.toLowerCase(), bindedMethod);
      return bindedMethod;
    });

    ['setWave'].forEach((fn) => (this[fn] = this[fn].bind(this)));
  }

  mouseEnter() {
    if (!this.currentItem || !this.isMouseOver) {
      const { setWave } = this;

      this.isMouseOver = true;
      // show plane
      gsap.to(this.material.uniforms.uWave, {
        duration: 0.5,
        value: 2.5,
        onUpdate: function () {
          setWave(this.targets()[0].value);
        },
      });
    }
  }

  mouseLeave() {
    const { setWave } = this;

    this.element.addEventListener('mouseleave', () => {
      gsap.to(this.material.uniforms.uWave, {
        duration: 1,
        value: 0,
        onUpdate: function () {
          setWave(this.targets()[0].value);
        },
      });
    });
  }

  setWave(value) {
    if (!this.material.uniforms) return false;
    this.material.uniforms.uWave.value = value;
  }
}

export default Image;
