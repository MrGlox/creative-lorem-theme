#ifdef GL_ES
precision highp float;
#endif

uniform sampler2D uTexture;

varying vec2 vUv;
varying float vWave;

void main(void) {
  float wave = vWave * 0.01;
  
  // vec3 color = texture2D(uTexture, vUv + wave).rgb;
  
  float r = texture2D(uTexture, vUv).r;
  float g = texture2D(uTexture, vUv - wave).g;
  float b = texture2D(uTexture, vUv + wave).b;
  
  vec3 color = vec3(r, g, b);
  
  gl_FragColor = vec4(color, 1.0);
}