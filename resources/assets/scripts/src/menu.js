class Menu {
  constructor() {
    // Elements to handle toggle menu
    this.dom = {
      body: document.body,
      header: document.querySelector('.header'),
      menu: document.querySelector('.header__menu'),
      links: document.querySelector('.header .menu a'),
      burger: document.querySelector('.header__icon'),
    };

    this.activeClass = 'header--open';

    // Resize breakpoint
    this.resizeBreakpoint = window.matchMedia('(min-width: 768px)');

    this.init = this.init.bind(this);
    this.toggleMenu = this.toggleMenu.bind(this);
  }

  init() {
    // Detect if clicked outside menu
    this.dom.burger.addEventListener('click', this.toggleMenu);

    // Event breakpoint
    this.resizeBreakpoint.addListener(this.menuResizing.bind(this));
  }

  /**
   * Toggle menu
   * @param {event} e
   */
  toggleMenu(e) {
    if (!this.dom.header.classList.contains(this.activeClass)) {
      this.dom.header.classList.add(this.activeClass);
      this.dom.body.classList.add('no-scroll');
      return;
    }

    this.dom.header.classList.remove(this.activeClass);
    this.dom.body.classList.remove('no-scroll');
  }

  /**
   * Open menu
   * @param {event} e
   */
  handleLinkClick(e) {
    this.dom.header.classList.remove(this.activeClass);
    this.dom.body.classList.remove('no-scroll');
  }

  /**
   * Remove menu-mobile active class if breakpoint reach desktop
   * @param {*} mediaQuery
   */
  menuResizing(mediaQuery = this.resizeBreakpoint) {
    if (!this.menuBody) return;

    if (mediaQuery.matches && this.menuBody.classList) {
      this.menuBody.classList.remove(this.activeClass);
    }
  }
}

export default Menu;
