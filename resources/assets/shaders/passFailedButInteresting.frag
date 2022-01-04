#ifdef GL_ES
precision highp float;
#endif

varying vec2 vUv;

uniform sampler2D tDiffuse;
uniform vec4 resolution;

void main(void) {
  vec2 uv = vUv;
  // get small circle around mouse, with distances to it
  // float c = circle(vUv, mouse, 0.0, 0.2);
  
  // get texture 3 times, each time with a different offset, depending on mouse speed:
  float r = texture2D(tDiffuse, uv.xy += vec2(0.5)).x;
  float g = texture2D(tDiffuse, uv.xy += vec2(0.525)).y;
  float b = texture2D(tDiffuse, uv.xy += vec2(0.55)).z;
  
  // combine it all to final output
  gl_FragColor = vec4(r, g, b, 1.0);
}