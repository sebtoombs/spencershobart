import "@ryangjchandler/spruce";
import "alpinejs";
import focusLock from "dom-focus-lock";

window.focusLock = focusLock;

window.Spruce.store("navigation", {
  open: false,
  triggerEl: null,
});

window.Spruce.watch("navigation.open", (value) => {
  const store = window.Spruce.store("navigation");
  const el = document.querySelector("#mobile-navigation");
  if (value) {
    focusLock.on(el);
  } else {
    focusLock.off(el);
    if (store.triggerEl) {
      store.triggerEl.focus();
      setTimeout(() => {
        store.triggerEl = null;
      });
    }
  }
});

// Alpine component controller
window.galleryLightbox = function () {
  return {
    imgModal: false,
    imgModalSrc: "",
    open() {
      this.imgModal = true;
      setTimeout(() => {
        focusLock.on(this.$refs.lightbox_modal);
      }, 100);
    },
  };
};

// Alpine component controller for site notice
window.siteNotice = function () {
  const localStorageKey = "spencershobart-site-notice";
  return {
    open: false,
    init() {
      const isDismissible =
        this.$refs.siteNotice.getAttribute("data-dismissible") === "true";
      const noticeId = this.$refs.siteNotice.getAttribute("data-id");
      const isOpen =
        !isDismissible || noticeId !== localStorage.getItem(localStorageKey);
      this.open = isOpen;
    },
    isOpen() {
      return this.open;
    },
    dismiss() {
      const noticeId = this.$refs.siteNotice.getAttribute("data-id");
      localStorage.setItem(localStorageKey, noticeId);
      this.open = false;
    },
  };
};

export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
