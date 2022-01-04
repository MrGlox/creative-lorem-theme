#ifdef GL_ES
precision highp float;
#endif

varying vec2 vUv;
varying float vDistort;
  
uniform float uAlpha;
uniform float uTime;
uniform float uIntensity;

vec3 cosPalette(float t, vec3 a, vec3 b, vec3 c, vec3 d) {
    return a + b * cos(6.28318 * (c * t + d));
}     
  
void main() {
    float distort = vDistort * uIntensity;
    
    vec3 brightness = vec3(0.902, 0.4863, 0.1529);
    vec3 contrast = vec3(0.5, 0.5, 0.5);
    vec3 oscilation = vec3(0.2, 0.2, 0.2);
    vec3 phase = vec3(0.902, 0.302, 0.8196);

    // vec3(0.902, 0.302, 0.8196)
    // vec3(0.902, 0.4863, 0.1529)

    // vec3 brightness = vec3(0.5333, 0.5333, 0.5333);
    // vec3 contrast = vec3(0.5, 0.5, 0.5);
    // vec3 oscilation = vec3(0.2, 0.2, 0.2);
    // vec3 phase =  vec3(0.202, 0.1863, 0.0529);

    vec3 color = cosPalette(distort, brightness, contrast, oscilation, phase);
    
    gl_FragColor = vec4(color, uAlpha);
}  