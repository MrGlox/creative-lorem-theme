export { lerp } from './lerp';

export const globalOffset = el => {
  var rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  return { x: rect.left + scrollLeft, y: rect.top + scrollTop };
};

export const getPageYScroll = () =>
  window.pageYOffset || document.documentElement.scrollTop;

export { splitText } from './split-text';
