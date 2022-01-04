class Tabs {
  constructor(element) {
    this.element = element;

    this.init = this.init.bind(this);

    if (this.element) {
      this.main = element.querySelector('.tabs__main');
      this.tabs = element.querySelectorAll('.tabs__list li header');
      this.item = element.querySelectorAll('.tabs__list li main');

      this.init();
    }
  }

  init() {
    this.main.style.minHeight = this.item[0].offsetHeight + 'px';

    this.tabs.forEach((element, index) => {
      element.addEventListener('click', () => {
        this.tabs.forEach(element =>
          element.classList.remove('tabs__title--active')
        );

        this.item.forEach(element =>
          element.classList.remove('tabs__content--active')
        );

        this.tabs[index].classList.add('tabs__title--active');
        this.item[index].classList.add('tabs__content--active');

        this.main.style.minHeight = this.item[index].offsetHeight + 'px';
      });
    });
  }
}

export default Tabs;
