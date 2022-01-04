import * as dat from 'dat.gui';
import glsl from 'glslify';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

import { EffectComposer, RenderPass, ShaderPass } from 'postprocessing';

import {
  Clock,
  Color,
  PerspectiveCamera,
  Scene,
  ShaderMaterial,
  TextureLoader,
  Vector2,
  WebGLRenderer,
} from 'three';

import fragmentPass from '../../shaders/pass.frag';
import vertexPass from '../../shaders/pass.vert';

let scrollValue = 0;

class Canvas {
  constructor(debug = false) {
    const sizes = this.viewport;
    this.container = document.body;

    this.loader = new TextureLoader();
    this.mouse = [0, 0];

    this.options = {
      sizes,
      renderer: {
        alpha: true,
        antialias: true,
        failIfMajorPerformanceCaveat: true,
        powerPreference: 'high-performance',
      },
      camera: {
        fov: 45,
        aspect: sizes.aspectRatio,
        near: 0.1,
        far: 1000,
      },
      params: {
        exposure: 1.3,
        bloomStrength: 0.9,
        bloomThreshold: 0,
        bloomRadius: 0,
      },
    };

    this.renderer = new WebGLRenderer(this.options.renderer);
    this.loader = new TextureLoader();
    this.canvas = this.renderer.domElement;
    this.scene = new Scene();

    const { fov, aspect, near, far } = this.options.camera;
    this.camera = new PerspectiveCamera(fov, aspect, near, far);
    this.camera.position.z = 50;

    this.clock = new Clock();
    this.mouse = new Vector2();

    if (debug) this.settings();

    this.init = this.init.bind(this);
    this.render = this.render.bind(this);
    this.resize = this.resize.bind(this);
  }

  setRenderer() {
    const { width, height } = this.options.sizes;

    this.renderer.setClearColor(0x1b0141, 0);
    this.renderer.setSize(width, height);
    this.renderer.autoClear = false;

    this.renderer.setPixelRatio(
      gsap.utils.clamp(1.5, 1, window.devicePixelRatio),
    );

    this.container.appendChild(this.canvas);
  }

  init() {
    this.setRenderer();
    this.initEffectComposer();

    document.addEventListener('mousemove', ({ screenX, screenY }) => {
      this.mouse = [screenX, screenY];
    });

    ScrollTrigger.create({
      onUpdate: (scroll) => (scrollValue = scroll.scroll()),
    });

    // request animation frame
    gsap.ticker.add(this.render);

    window.addEventListener('resize', this.resize);
  }

  /**
   * PAUSE BRB IN 5MIN
   */

  initEffectComposer() {
    const { width, height } = this.options.sizes;
    this.composer = new EffectComposer(this.renderer);
    const renderPass = new RenderPass(this.scene, this.camera);

    this.customPass = new ShaderPass(
      new ShaderMaterial({
        uniforms: {
          tDiffuse: {
            type: 't',
            value: null,
          },
          uResolution: {
            value: new Vector2(1, height / width),
          },
          uMouse: { value: new Vector2(-10, -10) },
        },
        vertexShader: glsl(vertexPass),
        fragmentShader: glsl(fragmentPass),
      }),
      'tDiffuse',
    );

    this.customPass.renderToScreen = true;

    this.composer.addPass(renderPass);
    this.composer.addPass(this.customPass);
  }

  render(time, deltaTime) {
    // if (deltaTime > 200) console.log('delta', deltaTime);

    for (let i = 0; i < this.scene.children.length; i++) {
      this.renderer.clearDepth();
      const child = this.scene.children[i];

      if (child.updatePosition && child.updateTime) {
        child.updatePosition(scrollValue);
        child.updateTime(time);
      }
    }

    this.customPass.screen.material.uniforms.uMouse.value = new Vector2(
      this.mouse[0],
      this.mouse[1],
    );
    // console.log(this.customPass);
    this.composer.render();

    if (this.resize) {
      this.camera.aspect = this.canvas.clientWidth / this.canvas.clientHeight;
    }
  }

  resize() {
    const { aspectRatio, width, height } = this.viewport;
    const needResize =
      this.canvas.clientWidth !== width || this.canvas.clientHeight !== height;

    if (needResize) {
      this.camera.aspect = aspectRatio;
      this.camera.updateProjectionMatrix();
      this.renderer.setSize(width, height);
      this.composer.setSize(width, height);
    }

    for (let i = 0; i < this.scene.children.length; i++) {
      const child = this.scene.children[i];
      child.resize();
    }

    return needResize;
  }

  clear() {
    while (this.scene.children.length > 0) {
      this.scene.remove(this.scene.children[0]);
      // console.log('clear', this.scene.children[0]);
    }
  }

  settings() {
    const gui = new dat.GUI(this.options);

    gui.add(this.options, 'blur', -0.49, 0.49, 0.05);
    gui.add(this.options, 'speed', 0.0, 2.0, 0.1);
    gui.add(this.options, 'noiseFreq', 0.0, 100.0, 0.1);
  }

  get viewport() {
    const { clientHeight } = document.body;
    const { innerWidth, innerHeight } = window;
    const aspectRatio = Math.min(2, innerWidth / innerHeight);

    return {
      width: innerWidth,
      height: innerHeight,
      clientHeight,
      aspectRatio,
    };
  }
}

export default Canvas;
