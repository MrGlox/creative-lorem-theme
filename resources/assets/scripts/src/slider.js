import Glide from '@glidejs/glide';

class Slider {
  constructor(element) {
    this.element = element;

    this.controls = {
      prev: document.querySelector('.slider__button--prev'),
      next: document.querySelector('.slider__button--next'),
      dots: document.querySelectorAll('.slider__dots-item'),
    };

    this.asideGlide = new Glide(document.querySelector('.slider__aside'), {
      type: 'carousel',
      perTouch: 1,
    });

    this.mainGlide = new Glide(document.querySelector('.slider__main'), {
      type: 'carousel',
      swipeThreshold: false,
      dragThreshold: false,
      perTouch: 1,
    });

    [...this.controls.dots].map((dot, index) => {
      if (index === 0) dot.classList.add('slider__dots-item--active');

      dot.addEventListener('click', () => {
        this.asideGlide.go('=' + index);
        this.mainGlide.go('=' + index);
      });
    });

    this.controls.next.addEventListener('click', () => {
      this.asideGlide.go('>');
      this.mainGlide.go('>');
    });

    this.controls.prev.addEventListener('click', () => {
      this.asideGlide.go('<');
      this.mainGlide.go('<');
    });

    this.asideGlide.on('swipe.end', () => {
      this.mainGlide.go('=' + this.asideGlide.index);
      this.handleClassList(this.asideGlide.index);
    });

    this.asideGlide.on('move.after', () => {
      this.mainGlide.go('=' + this.asideGlide.index);
      this.handleClassList(this.asideGlide.index);
    });

    this.asideGlide.mount();
    this.mainGlide.mount();
  }

  handleClassList(index) {
    [...this.controls.dots].map((dot, index) => {
      dot.classList.remove('slider__dots-item--active');
    });

    [...this.controls.dots][index].classList.add('slider__dots-item--active');
  }
}

export default Slider;

// const mainSlider = document.querySelector('.slider__main');
// const asideSlider = document.querySelector('.slider__aside');

// const slides = document.querySelectorAll(
//   '.slider--content .glide .slider__item'
// );

// if (mainSlider) {
// const asideGlide = new Glide('.slider__aside', {
//   perTouch: 1,
// });

// const mainGlide = new Glide('.slider__main', {
//   perTouch: 1,
// });

// const buttonPrev = document.querySelector('.slider--content .slider__prev');
// if (buttonPrev) {
//   buttonPrev.addEventListener('click', () => {
//     glide.go('<');
//   });
// }

// const buttonNext = document.querySelector('.slider--content .slider__next');
// if (buttonNext) {
//   buttonNext.addEventListener('click', () => {
//     glide.go('>');
//   });
// }

// glide.on(['mount.before', 'run.before', 'move'], function(ev) {
//   const currentIndex = glide.index || 0;

//   if (currentIndex === 0) {
//     buttonPrev.classList.add('slider__prev--disabled');
//     buttonPrev.disabled = true;
//     return;
//   }

//   if (currentIndex === slides.length - 1) {
//     buttonNext.classList.add('slider__next--disabled');
//     buttonNext.disabled = true;
//     return;
//   }

//   buttonPrev.classList.remove('slider__prev--disabled');
//   buttonPrev.disabled = false;
//   buttonNext.classList.remove('slider__next--disabled');
//   buttonNext.disabled = false;
// });

// glide.on(['mount.before'], () => {
//   slider.classList.add('glide--init');
// });

// }

// if (asideSlider) {
//   const asideGlide = new Glide('.slider__aside.glide', {
//     perTouch: 1,
//     rewind: false,
//     breakpoints: {
//       768: {
//         perView: 1,
//       },
//     },
//   });

//   asideGlide.mount();
// }
