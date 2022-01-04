/**
 * External Dependencies
 */
import { gsap } from 'gsap';
import barba from '@barba/core';
import lottie from 'lottie-web';

import { GlobalResize } from './src/events';
import SVGPlayer from './src/svg-player';
import CountUp from './src/count-up';

import Canvas from './src/canvas';
import Loader from './src/loader';
import Overlay from './src/overlay';
import Scroll from './src/scroll';
import Tabs from './src/tabs';
import Slider from './src/slider';

import Background from './src/webgl/background';
import Blob from './src/webgl/blob';
import Gradient from './src/webgl/gradient';
import Overflow from './src/webgl/overflow';

import Init from './src/init';
import ImagesLoading from './src/image-loading';

class Transitions {
  constructor() {
    // INIT CANVAS
    this.canvas = new Canvas();
    this.canvas.init();

    this.menuAnimations = document.querySelectorAll(
      '.menu__span, .menu__link',
      '.hero__title, .hero__link',
    );

    this.wrapper = document.querySelector('[data-scroll]'); // SCROLL INIT
    this.overflow = document.querySelector('.wrapper'); // OVERFLOW
    this.header = document.querySelector('.header'); // HEADER

    this.loaderContainer = document.querySelector('.shutter'); // HANDLE LOADER ANIMATION
  }

  init() {
    const _self = this; // prevent this binding

    barba.init({
      timeout: 15000,
      debug: true,
      transitions: [
        {
          name: 'default-transition',
          // ONCE
          beforeOnce: (data) =>
            new Promise((resolve) => _self.beforeOnce(data, resolve)),
          once: (data) => new Promise((resolve) => _self.once(data, resolve)),
          afterOnce: (data) => _self.afterOnce(data),

          // BEFORE
          before: (data) => _self.before(data),
          // before,
          beforeLeave: (data) => _self.beforeLeave(data),
          leave: () => new Promise((resolve) => _self.leave(resolve)),
          // afterLeave,

          // ENTER
          beforeEnter: (data) =>
            new Promise((resolve) => _self.beforeEnter(data, resolve)),
          enter: (data) => new Promise((resolve) => _self.enter(data, resolve)),
          afterEnter: (data) => _self.afterEnter(data),
          after: () => {
            _self.canvas.resize();
          },
        },
      ],
    });
  }

  beforeOnce({ next }, resolve) {
    // Init scroll button
    const scrollButton = document.querySelector('.hero .hero__scroll');
    if (scrollButton) {
      scrollButton.addEventListener('click', () => {
        const nextSection = document.querySelector('.section--hero + .section');

        if (nextSection) {
          window.scrollTo({
            left: 0,
            top: nextSection.getBoundingClientRect().y - 100,
            behavior: 'smooth',
          });
        }
      });
    }

    const element = document.querySelector('.shutter__content');
    this.loaderAnimation = lottie.loadAnimation({
      container: element, // the dom element that will contain the animation
      renderer: 'svg',
      autoplay: false,
      loop: false,
      path: element.dataset.src, // the path to the animation json
    });

    this.loaderAnimation.addEventListener('complete', () => resolve());

    this.loaderAnimation.addEventListener('DOMLoaded', () => {
      console.log('start animation');
      const loaderAnimation = this.loaderAnimation;

      const { markers } = loaderAnimation.animationData;
      const images = next.container.querySelectorAll('.js-image');
      const step = { value: 0 };

      const imageLoadingInstance = new ImagesLoading(
        images,
        this.canvas,
        () => {
          const timeline = gsap.timeline({
            onComplete: () => {
              if (
                imageLoadingInstance &&
                imageLoadingInstance.imagesLoadedCount === images.length
              ) {
                console.log('complete');
                loaderAnimation.play();
              }
            },
          });

          timeline.add(
            gsap.to(step, {
              overwrite: true,
              duration: 0.3,
              value: imageLoadingInstance
                ? (imageLoadingInstance.imagesLoadedCount /
                    imageLoadingInstance.images.length) *
                  markers[0].tm
                : 0,
              onUpdate: function () {
                const value = this.targets()[0].value;
                loaderAnimation.goToAndStop(value, true);
                step.value = value;
              },
            }),
          );
        },
        this.smoothScroll,
      );
    });

    const animations = next.container.querySelectorAll('.svg-player'); // HANDLE ANIMATIONS
    const tabs = next.container.querySelectorAll('.tabs'); // HANDLE GRADIENTS
    const sliders = next.container.querySelectorAll('.slider'); // HANDLE GRADIENTS
    const overlays = next.container.querySelectorAll('.js-overlay'); // HANDLE GRADIENTS
    const background = next.container.querySelector('.js-background'); // BACKGROUND MORPH
    const blobs = next.container.querySelectorAll('.js-blob'); // BACKGROUND MORPH
    const gradients = next.container.querySelectorAll('.js-gradient'); // HANDLE GRADIENTS

    this.smoothScroll = new Scroll(this.wrapper);

    this.animationInit = new Init(this.menuAnimations);
    this.animationInit.init();

    this.loader = new Loader(this.loaderContainer, true);

    animations.forEach((el) => new SVGPlayer(el));
    tabs.forEach((el) => new Tabs(el));
    sliders.forEach((el) => new Slider(el));
    overlays.forEach((el) => new Overlay(el));
    gradients.forEach((el, index) =>
      new Gradient().init(this.canvas, el, index),
    );

    background && new Background().init(this.canvas, background);

    blobs.forEach((el, index) => {
      new Blob().init(this.canvas, el, {
        speed: 0.3 + index * 0.12,
        strength: 0.42 - index * 0.12,
      });
    });

    new Overflow().init(this.canvas, next.container.parentNode, true);
  }

  once({ next }, resolve) {
    const countUp = next.container.querySelectorAll('.count-up'); // HANDLE ANIMATIONS
    const counts = [...countUp].map((el) => new CountUp(el));

    setTimeout(() => {
      counts.forEach((el) => el.init());
    }, 500);

    gsap.set('.contact__background circle', { opacity: 0 });
    this.loader.reveal(resolve);
  }

  afterOnce() {
    this.animationInit.start();
    document.body.classList.remove('no-scroll');

    let scrollTrigger = {};
    if (!document.body.classList.contains('page-template-page-contact')) {
      scrollTrigger = {
        scrollTrigger: {
          trigger: '.contact__background',
          start: 'top center',
        },
      };
    }

    gsap.to('.contact__background circle', {
      opacity: (index, element) =>
        element.getAttribute('opacity') ? element.getAttribute('opacity') : 1,
      duration: 1.2,
      stagger: {
        each: -0.3,
      },
      ease: 'bounce.out',
      ...scrollTrigger,
    });
  }

  before() {
    const element = document.querySelector('.shutter__content');
    this.loaderAnimation = lottie.loadAnimation({
      container: element, // the dom element that will contain the animation
      renderer: 'svg',
      autoplay: false,
      loop: false,
      path: element.dataset.src, // the path to the animation json
    });
  }

  beforeLeave() {
    const element = document.querySelector('.shutter__content');
    const svg = element.querySelector('svg');

    element.removeChild(svg);

    document.body.classList.add('no-scroll');
  }

  leave(resolve) {
    this.loader.hide(resolve);
  }

  beforeEnter({ next }, resolve) {
    window.scrollTo({
      left: 0,
      top: 0,
    });

    this.header.classList.remove('header--open');

    this.canvas.clear();
    this.smoothScroll.setHeight(next.container);

    /**
     * IMAGE LOADER
     */
    const scrollButton = document.querySelector('.hero .hero__scroll');
    if (scrollButton) {
      scrollButton.addEventListener('click', () => {
        const nextSection = document.querySelector('.section--hero + .section');

        if (nextSection) {
          window.scrollTo({
            left: 0,
            top: nextSection.getBoundingClientRect().y - 100,
            behavior: 'smooth',
          });
        }
      });
    }

    this.loaderAnimation.addEventListener('complete', () => resolve());

    const loaderAnimation = this.loaderAnimation;
    const { markers } = loaderAnimation.animationData;
    const images = next.container.querySelectorAll('.js-image');
    const step = { value: 0 };

    const imageLoadingInstance = new ImagesLoading(
      images,
      this.canvas,
      () => {
        const timeline = gsap.timeline({
          onComplete: () => {
            if (
              imageLoadingInstance &&
              imageLoadingInstance.imagesLoadedCount === images.length
            ) {
              console.log('complete');
              loaderAnimation.play();
            }
          },
        });

        timeline.add(
          gsap.to(step, {
            overwrite: true,
            duration: 0.3,
            value: imageLoadingInstance
              ? (imageLoadingInstance.imagesLoadedCount /
                  imageLoadingInstance.images.length) *
                markers[0].tm
              : 0,
            onUpdate: function () {
              const value = this.targets()[0].value;
              loaderAnimation.goToAndStop(value, true);
              step.value = value;
            },
          }),
        );
      },
      this.smoothScroll,
    );

    // RESET FORM
    const cf_selector = 'div.wpcf7 > form';
    const cf_forms = $(next.container).find(cf_selector);
    if (cf_forms.length > 0) {
      $(cf_selector).each(function () {
        const $form = $(this);
        wpcf7.initForm($form);
        if (wpcf7.cached) {
          wpcf7.refill($form);
        }
      });
    }

    document.querySelectorAll('div.wpcf7').forEach((el) =>
      el.addEventListener(
        'wpcf7invalid',
        function () {
          GlobalResize.init();
        },
        false,
      ),
    );

    /**
     * DOM RESET
     */
    const animations = next.container.querySelectorAll('.svg-player'); // HANDLE ANIMATIONS
    const tabs = next.container.querySelectorAll('.tabs'); // HANDLE GRADIENTS
    const sliders = next.container.querySelectorAll('.slider'); // HANDLE GRADIENTS
    const overlays = next.container.querySelectorAll('.js-overlay'); // HANDLE GRADIENTS
    const background = next.container.querySelector('.js-background'); // BACKGROUND MORPH
    const blobs = next.container.querySelectorAll('.js-blob'); // BACKGROUND MORPH
    const gradients = next.container.querySelectorAll('.js-gradient'); // HANDLE GRADIENTS

    animations.forEach((el) => new SVGPlayer(el));
    tabs.forEach((el) => new Tabs(el));
    sliders.forEach((el) => new Slider(el));
    overlays.forEach((el) => new Overlay(el));
    gradients.forEach((el, index) =>
      new Gradient().init(this.canvas, el, index),
    );

    background && new Background().init(this.canvas, background);

    blobs.forEach((el, index) => {
      new Blob().init(this.canvas, el, {
        speed: 0.3 + index * 0.12,
        strength: 0.42 - index * 0.12,
      });
    });

    new Overflow().init(this.canvas, next.container.parentNode, true);
  }

  enter({ next }, resolve) {
    this.loader.reveal(resolve);
  }

  afterEnter({ next }) {
    document.body.classList.remove('no-scroll');

    const countUp = next.container.querySelectorAll('.count-up'); // HANDLE COUNT

    const counts = [...countUp].map((el) => new CountUp(el));
    setTimeout(() => {
      counts.forEach((el) => el.init());
    }, 1000);

    let scrollTrigger = {};
    if (!document.body.classList.contains('page-template-page-contact')) {
      scrollTrigger = {
        scrollTrigger: {
          trigger: '.contact__background',
          start: 'center center',
          once: true,
        },
      };
    }

    gsap.to('.contact__background circle', {
      opacity: (index, element) =>
        element.getAttribute('opacity') ? element.getAttribute('opacity') : 1,
      duration: 1.2,
      stagger: {
        each: -0.3,
      },
      ease: 'bounce.out',
      ...scrollTrigger,
    });
  }
}

export default Transitions;
