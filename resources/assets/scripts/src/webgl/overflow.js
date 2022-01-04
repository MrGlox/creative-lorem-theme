import glslify from 'glslify';
import Object3D from '../utils/object3D';

import {
  Color,
  Mesh,
  MeshBasicMaterial,
  PlaneBufferGeometry,
  ShaderMaterial,
} from 'three';

// import fragmentShader from '../../../shaders/refraction.frag';
// import vertexShader from '../../../shaders/refraction.vert';

class Overflow extends Object3D {
  init({ camera, scene }, element) {
    super.init(camera, element);

    this.geometry = new PlaneBufferGeometry(1, 1, 1, 1);
    this.material = new MeshBasicMaterial({
      color: new Color(0x000),
      transparent: true,
      opacity: 0.18,
    });

    this.mesh = new Mesh(this.geometry, this.material);
    this.mesh.material.depthTest = false;
    this.mesh.renderOrder = -100;

    this.add(this.mesh);
    scene.add(this);
  }

  updateTime(time) {
    // console.log(time);
  }

  resize() {
    super.resize();
  }
}

export default Overflow;
