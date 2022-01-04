import { CircleGeometry, LineBasicMaterial, Mesh } from 'three';

import Object3D from '../utils/object3D';

class Line extends Object3D {
  init({ camera, scene }, element) {
    super.init(camera, element);

    this.geometry = new CircleGeometry(5, 32);
    this.material = new LineBasicMaterial({
      color: 0xffffff,
    });

    this.line = new Mesh(this.geometry, this.material);

    this.scale.set(1, 1, 1);

    this.add(this.line);
    scene.add(this);
  }

  updateTime(time) {
    this.position.x += 1;
  }
}

export default Line;
