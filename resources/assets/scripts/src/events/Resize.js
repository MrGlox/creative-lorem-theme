import Events from './Events';

const resizeObserver = new ResizeObserver(() => {
  resize.onResize();
});

class Resize {
  constructor() {
    this.init();
  }

  onResize() {
    Events.emit('resize');
  }

  on() {
    window.addEventListener('resize', this.onResize);
    resizeObserver.observe(document.querySelector('.content'));
  }

  init() {
    this.on();
  }
}

const resize = new Resize();
export default resize;
