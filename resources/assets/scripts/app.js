import 'jquery';

import './polyfill/forEach';
import './polyfill/objectFit';
import 'scroll-restoration-polyfill';

/**
 * External Dependencies
 */
import barba from '@barba/core';
import barbaPrefetch from '@barba/prefetch';

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

import Menu from './src/menu';
import Transitions from './transitions';

(() => {
  document.body.classList.remove('loading');
  gsap.registerPlugin(ScrollTrigger);

  barba.use(barbaPrefetch);
  barba.hooks.afterLeave(({ next }) => {
    document.body.setAttribute(
      'class',
      next.html
        .match(/<body class="(.*?)"/g)[0]
        .replace('<body class="', '')
        .replace('"', ''),
    );
  });

  barba.hooks.beforeEnter(() => {
    if ('scrollRestoration' in history) {
      history.scrollRestoration = 'manual';
    }
  });

  const date = document.querySelector('#styledDate span');
  setInterval(() => {
    date.innerHTML = new Date().toISOString();
  }, 1000);

  new Menu().init();
  new Transitions().init();
})();
