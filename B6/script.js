document.addEventListener("DOMContentLoaded", (e) => {
  /**@type {HTMLVideoElement} */
  const videoEl = document.querySelector("#video");
  /**@type {HTMLVideoElement} */
  const scrubEl = document.querySelector("#scrub");
  const scrubTimeEl = document.querySelector("#scrub-time");
  const scrubContainerEl = document.querySelector(".scrub-container");
  /**@type {HTMLProgressElement} */
  const progressEl = document.querySelector("#progress");
  /**@type {HTMLDivElement} */
  const timeEl = document.querySelector("#time");
  /**@type {HTMLButtonElement} */
  const playPauseEl = document.querySelector("#play-pause");

  videoEl.addEventListener("timeupdate", (e) => {
    if (videoEl.duration) {
      progressEl.max = videoEl.duration;
    }
    progressEl.value = videoEl.currentTime;
    timeEl.textContent = `${formatSeconds(videoEl.currentTime)}/${formatSeconds(
      videoEl.duration
    )}`;
  });

  const formatSeconds = (sec) => {
    let m = Math.floor(sec / 60);
    let s = Math.floor(sec % 60);
    return `${m.toString().padStart(2, "0")}:${s.toString().padStart(2, "0")}`;
  };

  playPauseEl.addEventListener("click", (e) => {
    if (videoEl.paused) {
      videoEl.play();
      playPauseEl.textContent = "| |";
    } else {
      videoEl.pause();
      playPauseEl.textContent = ">";
    }
  });

  let down = false;
  progressEl.addEventListener("mouseup", (e) => (down = false));
  progressEl.addEventListener("mouseleave", (e) => (down = false));
  progressEl.addEventListener("mousedown", (e) => {
    down = true;
    const r = progressEl.getBoundingClientRect();
    const x = (e.pageX - r.left) / r.width;
    videoEl.currentTime = x * videoEl.duration;
  });
  progressEl.addEventListener("mousemove", (e) => {
    const r = progressEl.getBoundingClientRect();
    const x = (e.pageX - r.left) / r.width;
    if (down) {
      videoEl.currentTime = x * videoEl.duration;
    }
    scrubEl.currentTime = x * videoEl.duration;
    scrubTimeEl.textContent = formatSeconds(x * videoEl.duration);
    scrubContainerEl.style.left = e.pageX - r.left + "px";
  });
});
