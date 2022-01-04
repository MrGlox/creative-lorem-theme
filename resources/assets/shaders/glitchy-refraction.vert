#ifdef GL_ES
precision highp float;
#endif

varying vec3 vWorldCameraDir;
varying vec3 vWorldNormal;
varying vec3 vViewNormal;

void main() {
    vec4 worldPosition = modelMatrix * vec4( position, 1.0);

    vWorldCameraDir = worldPosition.xyz - cameraPosition;
    vWorldCameraDir = normalize(vec3(-vWorldCameraDir.x, vWorldCameraDir.yz));
    vWorldNormal = (modelMatrix * vec4(normal, 0.0)).xyz;
    vWorldNormal = normalize(vec3(-vWorldNormal.x, vWorldNormal.yz));
    vViewNormal = normalize( modelViewMatrix * vec4(normal, 0.0)).xyz;

    gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
}