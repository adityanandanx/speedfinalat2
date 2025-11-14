document.addEventListener("DOMContentLoaded", (e) => {
  /**@type {HTMLCanvasElement} */
  const drawCanvas = document.getElementById("draw");
  /**@type {HTMLCanvasElement} */
  const asciiCanvas = document.getElementById("ascii");
  const w = 500;
  const h = 500;
  drawCanvas.width = asciiCanvas.width = w;
  drawCanvas.height = asciiCanvas.height = h;

  const d = drawCanvas.getContext("2d");
  const a = asciiCanvas.getContext("2d");

  let down = false;
  drawCanvas.addEventListener("mousedown", (e) => (down = true));
  drawCanvas.addEventListener("mouseup", (e) => (down = false));
  drawCanvas.addEventListener("mouseleave", (e) => (down = false));

  const th = 16;
  a.font = `${th}px monospace`;
  a.textAlign = "left";
  a.textBaseline = "top";
  const tw = Math.floor(a.measureText("@").width);
  console.log({ th, tw });

  drawCanvas.addEventListener("mousemove", (e) => {
    if (!down) return;

    const x = e.offsetX;
    const y = e.offsetY;
    d.fillStyle = "red";
    d.beginPath();
    d.arc(x, y, 20, 0, Math.PI * 2);
    d.closePath();
    d.fill();
    updateAscii();
  });
  drawCanvas.addEventListener("mousedown", (e) => {
    if (!down) return;

    const x = e.offsetX;
    const y = e.offsetY;
    d.fillStyle = "red";
    d.beginPath();
    d.arc(x, y, 20, 0, Math.PI * 2);
    d.closePath();
    d.fill();
    updateAscii();
  });
  drawCanvas.addEventListener("touchmove", (e) => {
    const r = drawCanvas.getBoundingClientRect();

    const x = e.targetTouches[0].pageX - r.left;
    const y = e.targetTouches[0].pageY - r.top;
    d.fillStyle = "red";
    d.beginPath();
    d.arc(x, y, 20, 0, Math.PI * 2);
    d.closePath();
    d.fill();
    updateAscii();
    e.preventDefault();
  });

  const updateAscii = () => {
    const img = d.getImageData(0, 0, w, h);
    a.clearRect(0, 0, w, h);
    a.fillStyle = "white";
    for (let y = 0; y < h; y += th) {
      for (let x = 0; x < w; x += tw) {
        const index = y * (w * 4) + x * 4;
        // console.log({ index });
        const alpha = img.data[index];
        if (alpha > 0) {
          a.fillText("@", x, y, tw);
          //   a.fillRect(x, y, tw, th);
        }
      }
    }
  };
});
