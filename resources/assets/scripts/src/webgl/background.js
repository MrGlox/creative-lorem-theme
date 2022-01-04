// import gsap from 'gsap';
import glslify from 'glslify';
import gsap from 'gsap/gsap-core';

import { Mesh, PlaneBufferGeometry, ShaderMaterial, Vector4 } from 'three';

import fragmentShader from '../../../shaders/wave.frag';
import vertexShader from '../../../shaders/wave.vert';

import Object3D from '../utils/object3D';

class MetaBall extends Object3D {
  init({ camera, scene }, element) {
    super.init(camera, element);

    this.options = {
      blur: -0.2,
      speed: 0.2,
      noiseFreq: 5.0,
    };

    this.geometry = new PlaneBufferGeometry(40, 40, 8, 8);
    this.material = new ShaderMaterial({
      transparent: true,
      fragmentShader: glslify(fragmentShader),
      vertexShader: glslify(vertexShader),
      uniforms: {
        u_time: { type: 'f', value: 0 },
        u_resolution: { type: 'v4', value: new Vector4() },
        u_aspect: { type: 'f', value: this.aspectRatio },
        u_noiseFreq: { value: 0 },
        blur: { value: 0 },
        speed: { value: 0 },
      },
    });

    this.mesh = new Mesh(this.geometry, this.material);
    this.mesh.material.depthTest = false;
    this.mesh.renderOrder = -100;

    this.scale.set(2, 2, 2);

    this.positionOffset = 100;
    this.position.y += this.positionOffset;

    this.add(this.mesh);
    scene.add(this);
  }

  updateTime(time) {
    // console.log(time);
    const { blur, speed, noiseFreq } = this.options;

    this.material.uniforms.u_time.value = time;
    this.material.uniforms.blur.value = blur;
    this.material.uniforms.speed.value = speed;
    this.material.uniforms.u_noiseFreq.value = noiseFreq;
  }

  resize() {
    super.resize();
    this.scale.set(2, 2, 2);
  }

  start() {
    gsap.add.ticker(() => {
      this.positionOffset -= 1;
    });
  }
}

export default MetaBall;
