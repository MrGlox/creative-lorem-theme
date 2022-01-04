import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

class CountUp {
  constructor(el) {
    this.element = el;

    this.duration = 2000;
    this.frameDuration = 1000 / 60;

    this.timeStart = 0;
    this.frameStart = 0;
    this.countTo = 0;

    this.totalFrames = Math.round(this.duration / this.frameDuration);
    this.ease = gsap.parseEase('quad.out');

    this.countTo = parseInt(this.element.innerHTML, 10);
    this.element.innerHTML = 0;

    this.init = this.init.bind(this);
    this.tick = this.tick.bind(this);
  }

  tick(time, deltaTime, frame) {
    // END
    if (this.totalFrames === frame - this.frameStart) {
      gsap.ticker.remove(this.tick);
      return;
    }

    if (this.timeStart === 0 && this.frameStart === 0) {
      this.timeStart = time;
      this.frameStart = frame;
    }

    // Start the animation running 60 times per second
    const progress = this.ease((frame - this.frameStart) / this.totalFrames);
    // Use the progress value to calculate the current count
    const currentCount = Math.round(this.countTo * progress);

    // If the current count has changed, update the element
    if (parseInt(this.element.innerHTML, 10) !== currentCount) {
      this.element.innerHTML = currentCount;
    }
  }

  init() {
    ScrollTrigger.create({
      trigger: this.element,
      start: 'top center',
      onEnter: () => {
        if (!this.played) gsap.ticker.add(this.tick);
        this.played = true;
      },
    });
  }
}

export default CountUp;
