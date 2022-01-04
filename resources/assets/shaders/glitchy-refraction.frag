#ifdef GL_ES
precision highp float;
#endif

#define REF_WAVELENGTH 579.0
#define RED_WAVELENGTH 650.0
#define GREEN_WAVELENGTH 525.0
#define BLUE_WAVELENGTH 440.0

uniform vec2 resolution;
uniform sampler2D backNormals;
uniform samplerCube envMap;

uniform float refractionIndex;
uniform vec3 color;
uniform float dispersion;
uniform float roughness;

varying vec3 vWorldCameraDir;
varying vec3 vWorldNormal;
varying vec3 vViewNormal;

vec4 refractLight(float wavelength, vec3 backFaceNormal) {
    float index = 1.0 / mix(refractionIndex, refractionIndex * REF_WAVELENGTH / wavelength, dispersion);
    vec3 dir = vWorldCameraDir;
    dir = refract(dir, vWorldNormal, index);
    dir = refract(dir, backFaceNormal, index);
    return textureCube(envMap, dir);
}

vec3 fresnelSchlick(float cosTheta, vec3 F0) {
    return F0 + (1.0 - F0) * pow(1.0 + cosTheta, 5.0);
}

void main() {
    vec3 backFaceNormal = texture2D(backNormals, gl_FragCoord.xy / resolution).rgb;

    float r = refractLight(RED_WAVELENGTH, backFaceNormal).r;
    float g = refractLight(GREEN_WAVELENGTH, backFaceNormal).g;
    float b = refractLight(BLUE_WAVELENGTH, backFaceNormal).b;

    vec3 fresnel = fresnelSchlick(dot(vec3(0.0,0.0,-1.0), vViewNormal), vec3(0.04));
    vec3 reflectedColor = textureCube(envMap, reflect(vWorldCameraDir, vWorldNormal)).rgb * saturate((1.0 - roughness) + fresnel);

    gl_FragColor.rgb = vec3(r,g,b) * color + reflectedColor;
}