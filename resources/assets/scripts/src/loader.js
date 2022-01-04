import { gsap } from 'gsap';

class Loader {
  constructor(element, debug = false) {
    this.container = element;
    this.inner = element.querySelector('.shutter__move');
    this.options = {
      angle: 8,
    };

    this.inner.style.width = `calc(100vw * ${Math.abs(
      Math.cos((this.options.angle * Math.PI) / 180),
    )} + 120vh * ${Math.abs(Math.sin((this.options.angle * Math.PI) / 180))})`;
    this.inner.style.height = `calc(100vw * ${Math.abs(
      Math.sin((this.options.angle * Math.PI) / 180),
    )} + 120vh * ${Math.abs(Math.cos((this.options.angle * Math.PI) / 180))})`;

    this.container.style.transform = `rotate3d(0,0,1,${this.options.angle}deg)`;
    this.inner.style = this.translation();

    this.debug = debug;

    document.body.classList.add('no-scroll');
  }

  rotation() {
    let style = `
      width: ${
        140 * Math.abs(Math.cos((this.options.angle * Math.PI) / 180)) +
        140 * Math.abs(Math.sin((this.options.angle * Math.PI) / 180))
      }%;
    `;

    style += `
      height: ${
        130 * Math.abs(Math.sin((this.options.angle * Math.PI) / 180)) +
        130 * Math.abs(Math.cos((this.options.angle * Math.PI) / 180))
      }%;
    `;

    style += `
      transform: translateX(-50%) translateY(-50%) rotate3d(0,0,1,${this.options.angle}deg);
    `;

    return style;
  }

  translation() {
    return `
      transform: rotate3d(0,0,1,-${this.options.angle}deg);
    `;
  }

  reveal(resolve) {
    // Pointer events related class
    this.container.classList.add('shutter--hidden');

    // "Unreveal effect" (inner moves to one direction and reverse moves to the opposite one)
    gsap.to(this.container, {
      duration: 1.8,
      ease: 'expo.inOut',
      y: '-110%',
    });

    gsap.to(this.inner, {
      duration: 1.8,
      ease: 'expo.inOut',
      y: '140%',
      onStart: () => {
        setTimeout(() => {
          resolve();
        }, 800);
      },
      onComplete: () => {
        this.completeEnter();
      },
    });
  }

  hide(resolve) {
    if (this.inner) this.inner.style.display = 'block';

    // "Unreveal effect" (inner moves to one direction and reverse moves to the opposite one)
    gsap.to(this.container, {
      duration: 1.8,
      ease: 'expo.inOut',
      y: '0',
    });

    gsap.to(this.inner, {
      duration: 1.8,
      ease: 'expo.inOut',
      y: '0',
      onComplete: () => {
        // Pointer events related class
        this.container.classList.remove('shutter--hidden');

        resolve();
      },
    });
  }

  completeEnter() {
    if (this.inner) this.inner.style.display = 'none';
  }
}

export default Loader;
