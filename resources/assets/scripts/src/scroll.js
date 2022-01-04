import { Events } from './events';

class Scroll {
  constructor() {
    this.diff = 0;

    this.bindMethods();

    this.dom = {
      el: document.querySelector('[data-scroll]'),
      content: document.querySelector('[data-scroll-content]'),
      header: document.querySelector('.header'),
      dots: document.querySelector('.lines__doted'),
      footer: document.querySelector('.footer'),
    };

    this.init();
  }

  bindMethods() {
    ['run', 'resize'].forEach((fn) => (this[fn] = this[fn].bind(this)));
  }

  setStyles() {
    Object.assign(this.dom.el.style, {
      position: 'fixed',
      top: '24px',
      left: '24px',
      height: '100%',
      width: 'calc(100vw - 48px)',
    });
  }

  setHeight(element = false) {
    if (!element) {
      document.body.style.height = `${this.dom.content.offsetHeight + 48}px`;
      return;
    }

    document.body.style.height = `${
      element.offsetHeight + this.dom.footer.offsetHeight + 48
    }px`;
  }

  resize() {
    this.setHeight();
  }

  run({ current, target }) {
    this.diff = target - current;
    const acc = this.diff / window.innerWidth;

    this.dom.content.style.transform = `translate3d(
      0, -${current + acc}px, 0
    )`;

    if (this.dom.dots) {
      this.dom.dots.style.transform = `translateX(-50%) 
        translateY(-50%)
        rotate(${90 + (current + this.diff - acc) / 10}deg)
      `;
    }

    if (current < 80) {
      if (!this.dom.header.classList.contains('header--sticky')) return;
      this.dom.header.classList.remove('header--sticky');
      return;
    }

    if (this.dom.header.classList.contains('header--sticky')) return;
    this.dom.header.classList.add('header--sticky');
  }

  on() {
    this.setStyles();
    this.setHeight();

    Events.on('tick', this.run);
    Events.on('resize', this.resize);
  }

  off() {
    Events.off('tick', this.run);
    Events.off('resize', this.resize);
  }

  init() {
    this.on();
  }
}

export default Scroll;
