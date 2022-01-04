#ifdef GL_ES
precision highp float;
#endif

uniform vec3 uColorStart;
uniform vec3 uColorEnd;

uniform int uOrientation; // 1 : vertical | 2 : horizontal
uniform float uAlpha;

varying vec2 vUv;

void main(void) {
  // x < 0 = transparent, > 1 = opaque
  float alpha = smoothstep(0.0, 1.0, vUv.x);
   // x < 1 = color1, > 2 = color2
  float colorMix = smoothstep(0.0, 2.0, vUv.x);

  if(uOrientation == 1) {
    // y < 0 = transparent, > 1 = opaque
    alpha = smoothstep(0.0, 1.0, vUv.y);
    // y < 1 = color1, > 2 = color2
    colorMix = smoothstep(0.0, 2.0, vUv.y);
  } 
  
  gl_FragColor = vec4(mix(uColorStart, uColorEnd, colorMix), alpha * uAlpha);
}