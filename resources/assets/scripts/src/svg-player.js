import lottie from 'lottie-web';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

class SVGPlayer {
  constructor(element) {
    this.element = element;

    if (this.element) {
      this.animation = lottie.loadAnimation({
        container: this.element, // the dom element that will contain the animation
        renderer: 'svg',
        loop: false,
        autoplay: false,
        path: this.element.dataset.src, // the path to the animation json
      });

      this.init();
    }
  }

  init() {
    ScrollTrigger.create({
      trigger: this.element.parentNode.parentNode,
      start: 'top center',
      onToggle: () =>
        setTimeout(() => {
          this.animation.play();
        }, 1000),
    });
  }
}

export default SVGPlayer;
