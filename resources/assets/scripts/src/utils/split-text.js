import charming from 'charming';

/**
 * Set the chars spans
 * @param {NodeList} element
 * @param {String} type
 */
const splitText = (element, type = '') => {
  if (!element) {
    return false;
  }

  let elements = [];

  element.innerHTML = element.innerHTML.trim();

  if (type === 'words') {
    charming(element, {
      splitRegex: /(\s+)/,
      classPrefix: 'word',
    });

    elements = [...element.querySelectorAll('span')];
    elements.map((element) => element.classList.add('words'));

    return elements;
  } else if (type === 'chars in words') {
    charming(element, {
      splitRegex: /(\s+)/,
      classPrefix: 'word',
    });

    elements = [...element.querySelectorAll('span')];
    elements.map((element) => element.classList.add('words'));
  }

  charming(element);

  elements = [...element.querySelectorAll('span')];

  elements.map((el) => {
    if (el.innerHTML === ' ') {
      el.innerHTML = '&nbsp;';
    }
  });

  // const charsInWords = elements
  //   .filter(element => !element.classList.contains('words'))
  //   .map(element => element.classList.add('chars'))

  // if (type === 'chars in word') {
  //   console.log(charsInWords)
  //   return charsInWords
  // }

  return elements;
};

export { splitText };
