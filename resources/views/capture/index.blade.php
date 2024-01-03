<!DOCTYPE html><html lang="ja"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width">

<h1>Camera.js</h1>
<button id=btnstart>start</button> <button id=btnstop>stop</button>
<label><input type=checkbox id=chkback checked>backcamera</label>
<label><input type=checkbox id=chkmirror>mirror</label>
<br>
<video id=video style="max-width:90vw"></video><br>
<hr>
<a href=https://github.com/code4fukui/Camera/>src on GitHub</a>

<script type="module">
import { Camera } from "{{ asset('assets/custom/js/Camera.js') }}";

let camera = null;

btnstart.onclick = async () => {
  if (camera) {
    await camera.stop();
  }
  camera = new Camera(video, {
    onFrame: async () => {
      // use video element as image
    },
    backcamera: chkback.checked,
    fps: 1,
  });
  await camera.start();
};
btnstop.onclick = async () => {
  if (camera) {
    await camera.stop();
    camera = null;
  }
};
chkback.onchange = async () => {
  if (camera) {
    await camera.flip();
  }
};
chkmirror.onchange = () => {
  video.style.transform = chkmirror.checked ? "scale(-1,1)" : "scale(1,1)";
};
</script>