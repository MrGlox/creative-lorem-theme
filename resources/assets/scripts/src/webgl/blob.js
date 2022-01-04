// import gsap from 'gsap';
import glslify from 'glslify';

import { Group, Mesh, IcosahedronBufferGeometry, ShaderMaterial } from 'three';

import fragmentShader from '../../../shaders/blob.frag';
import vertexShader from '../../../shaders/blob.vert';

import Object3D from '../utils/object3D';


class Blob extends Object3D {
  init({ camera, scene }, element, opts = {}) {
    super.init(camera, element);

    this.group = new Group()

    const { speed = 0.3, strength = 0.42, opacity = 1.0, size = 4.5 } = opts;
    this.size = size;
    this.settings = {
      speed,
      density: 0.45,
      strength,
      intensity: 1.8,
    };

    const geometry = new IcosahedronBufferGeometry(1, 64);

    const blobMaterial = new ShaderMaterial({
      transparent: true,
      vertexShader: glslify(vertexShader),
      fragmentShader: glslify(fragmentShader),
      uniforms: {
        uAlpha: { value: opacity },
        uTime: { value: 0 },
        uSpeed: { value: this.settings.speed },
        uNoiseDensity: { value: this.settings.density },
        uNoiseStrength: { value: this.settings.strength },
        uIntensity: { value: this.settings.intensity },
      },
    });

    const membraneMaterial = new ShaderMaterial({
      transparent: true,

      vertexShader: glslify(vertexShader),
      fragmentShader: glslify(fragmentShader),
      uniforms: {
        uAlpha: { value: 0.08 },
        uTime: { value: 0 },
        uSpeed: { value: this.settings.speed },
        uNoiseDensity: { value: this.settings.density },
        uNoiseStrength: { value: this.settings.strength },
        uIntensity: { value: this.settings.intensity },
      },
    });

    this.blob = new Mesh(geometry, blobMaterial);

    this.membrane = new Mesh(geometry, membraneMaterial);
    this.membrane.scale.set(1.1, 1.1, 1.1)

    this.group.add(this.blob)
    this.group.add(this.membrane)

    this.add(this.group);
    scene.add(this);
  }

  updateTime(time) {
    const rand = Math.random()
    this.group.rotateX(0.005 * rand)
    this.group.rotateY(0.005 * rand)

    // Update uniforms
    this.group.children.map(mesh => {
      mesh.material.uniforms.uTime.value = time;
      mesh.material.uniforms.uSpeed.value = this.settings.speed;
      mesh.material.uniforms.uNoiseDensity.value = this.settings.density;
      mesh.material.uniforms.uNoiseStrength.value = this.settings.strength;
      mesh.material.uniforms.uIntensity.value = this.settings.intensity;
    })
  }

  resize() {
    super.resize();
  }
}

export default Blob;
