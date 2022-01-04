// ——————————————————————————————————————————————————
// TextScramble
// ——————————————————————————————————————————————————

import { gsap } from 'gsap';

class TextScramble {
  constructor(el) {
    this.el = el;
    this.chars = '!<>-_\\/[]{}—=+*^?#________';

    this.setText = this.setText.bind(this);
    this.update = this.update.bind(this);
  }

  setText(newText) {
    const oldText = this.el.innerText;
    const length = Math.max(oldText.length, newText.length);
    const promise = new Promise(resolve => (this.resolve = resolve));

    this.queue = [];

    for (let i = 0; i < length; i++) {
      const from = ''; // oldText[i] ||
      const to = newText[i] || '';
      const start = Math.floor(Math.random() * 40);
      const end = start + Math.floor(Math.random() * 20);

      this.queue.push({ from, to, start, end });
    }

    this.frame = 0;

    return promise;
  }

  start() {
    const ease = gsap.parseEase('power3.in');

    this.ticker = (time, deltaTime, frame) =>
      this.update({
        time,
        deltaTime,
        frame: ease(frame / 100), // frame / (Math.log(frame * 10) / Math.log(time))
      });

    gsap.ticker.add(this.ticker);
  }

  update({ frame }) {
    let output = '';
    let complete = 0;

    for (let i = 0, n = this.queue.length; i < n; i++) {
      let { from, to, start, end, char } = this.queue[i];

      if (this.frame >= end) {
        complete++;
        output += to;
      } else if (this.frame >= start) {
        if (!char || Math.random() < 0.28) {
          char = this.randomChar();
          this.queue[i].char = char;
        }

        output += `<span class="glitch">${char}</span>`;
      } else {
        output += from;
      }
    }

    this.el.innerHTML = output;

    if (complete === this.queue.length) {
      gsap.ticker.remove(this.ticker);
      this.resolve();
    } else {
      this.frame = frame;
    }
  }

  randomChar() {
    return this.chars[Math.floor(Math.random() * this.chars.length)];
  }
}

export default TextScramble;
