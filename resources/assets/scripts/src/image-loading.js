import Image from './webgl/image';

class ImagesLoading {
  constructor(images, canvas, trigger, scroll) {
    this.canvas = canvas;
    this.images = [...images];

    this.scroll = scroll;

    this.promises = [];
    this.imagesLoadedCount = 0;

    if (images.length === 0) {
      trigger();
      return;
    }

    this.images.map((image, index) => {
      image.src = image.dataset.src;
      this.promises.push(this.loaded(image, trigger, index));
    });
  }

  allLoaded(resolve) {
    return Promise.all([...this.promises])
      .then((res) => {
        console.log('all loaded', res);
        resolve();
      })
      .catch((err) => {
        resolve();
        throw err;
      });
  }

  loaded(image, trigger, index) {
    return new Promise((resolve, reject) => {
      image.addEventListener('load', () => {
        console.log('loaded');

        new Image().init(this.canvas, image, index, this.scroll);
        this.imagesLoadedCount++;
        trigger();

        resolve('loaded');
      });

      image.addEventListener('error', () => reject());
    });
  }
}

export default ImagesLoading;
