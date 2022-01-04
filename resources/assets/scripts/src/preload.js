// Tip: use with await.
// const preloaded = await preloadAll(['img1.jpg', 'img2.jpg'])

export const preload = src =>
  new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = resolve;
    img.onerror = reject;
    img.src = src;

    console.log("loaded", src);
  }).catch(err => {
    throw err;
  });

export const preloadAll = (srcs, imagesInit, resolve) => {
  Promise.all(srcs.map(preload)).then(() => {
    imagesInit();
    resolve();
  });
};
