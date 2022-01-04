import gsap from 'gsap';
import glsl from 'glslify';
import { Mesh, PlaneBufferGeometry, ShaderMaterial } from 'three';

import Object3D from '../utils/object3D';

import fragment from '../../../shaders/gradient.frag';
import vertex from '../../../shaders/gradient.vert';

class Gradient extends Object3D {
  init({ camera, scene }, element) {
    super.init(camera, element);

    this.geometry = new PlaneBufferGeometry(1, 1, 1, 1);
    this.material = new ShaderMaterial({
      fragmentShader: glsl(fragment),
      vertexShader: glsl(vertex),
    });

    const { direction = 'horizontal', opacity = 0.33 } = element.dataset;
    this.opacity = opacity;

    this.material.transparent = true;
    this.material.uniforms = {
      uResolution: { value: { x: 0, y: 0 } },
      uColorStart: { value: new THREE.Color('rgb(255, 0, 100)') },
      uColorEnd: { value: new THREE.Color('rgb(255, 0, 100)') },
      uOrientation: { value: direction === 'vertical' ? 1 : 0 },
      uAlpha: { value: Number(0) },
    };

    this.mesh = new Mesh(this.geometry, this.material);

    this.add(this.mesh);
    scene.add(this);

    this.setAlpha = this.setAlpha.bind(this);
    this.initAnimation();
  }

  initAnimation() {
    const { setAlpha } = this;

    const percent = { value: 0 };
    gsap.to(percent, {
      duration: 1.3,
      scrollTrigger: {
        trigger: '.' + this.element.className.replaceAll(' ', '.'),
        start: 'top center',
        once: true,
      }, // start the animation when ".box" enters the viewport (once)
      value: this.opacity,
      ease: 'bounce.out',
      onUpdate: function () {
        setAlpha(this.targets()[0].value);
      },
    });
  }

  setAlpha(value) {
    if (!this.material.uniforms) return false;
    this.material.uniforms.uAlpha.value = value;
  }

  updateTime(time) {}
}

export default Gradient;
