import { rgba } from 'polished';

class Overlay {
  constructor(element) {
    this.element = element;

    if (this.element) {
      const color = this.element.dataset.color;

      if (!color) return;

      this.element.style = `background-image: linear-gradient(19deg, 
        ${rgba(color, 0.8)} 34%, ${rgba(color, 0)} 99.9%);`;
    }
  }
}

export default Overlay;
