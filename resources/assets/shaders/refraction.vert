#ifdef GL_ES
precision highp float;
#endif

varying vec3 worldNormal;
varying vec3 viewDirection;

void main() {
	vec4 worldPosition = modelMatrix * vec4( position, 1.0);
	worldNormal = normalize( modelViewMatrix * vec4(normal, 0.)).xyz;
	viewDirection = normalize(worldPosition.xyz - cameraPosition);;

	gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
}