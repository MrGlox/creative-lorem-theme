import TextScramble from './text-scramble';
import { gsap } from 'gsap';

import { splitText } from './utils';

class TextTransitions {
  constructor(elements) {
    this.title = document.querySelector('h1.hero__title');
    this.links = document.querySelectorAll('.hero__link');
    this.elements = elements;

    if (!this.title) return;

    this.titleSplit = splitText(this.title, 'chars in words').filter(
      (element) => !element.classList.contains('words'),
    );

    this.init = this.init.bind(this);
    this.start = this.start.bind(this);
  }

  init() {
    this.textScrambles = [...this.elements, ...this.links].map((el) => {
      const fx = new TextScramble(el);

      let counter = 0;
      fx.setText(el.innerText);
      counter = (counter + 1) % el.innerText.length;

      el.innerText = '';

      return fx;
    });
  }

  start() {
    this.textScrambles.map((fx) => {
      fx.start();
    });

    gsap.set(this.titleSplit, {
      opacity: 1,
    });

    gsap.from(this.titleSplit, {
      duration: 0.7,
      yPercent: 120,
      ease: 'power3.out',
      stagger: 0.03,
    });
  }
}

export default TextTransitions;
