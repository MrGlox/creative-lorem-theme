import LazyLoad from "vanilla-lazyload";

// const logEvent = (eventName, element) => {
//   console.log(
//     Date.now(),
//     eventName,
//     element,
//     element.getAttribute("data-src"),
//     element.getAttribute("data-srcset")
//   );
// };

const lazyLoadOptions = {
  elements_selector: "img.lazy, .lazy img, .lazy source",
  to_webp: true

  // callback_enter: element => {
  //   logEvent("ENTERED", element);
  // },
  // callback_load: element => {
  //   logEvent("LOADED", element);
  // },
  // callback_set: element => {
  //   logEvent("SET", element);
  // },
  // callback_error: element => {
  //   logEvent("ERROR", element);
  //   element.src = "https://placehold.it/220x280?text=Placeholder";
  // }
};

new LazyLoad(lazyLoadOptions);
