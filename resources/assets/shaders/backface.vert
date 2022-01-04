varying vec3 worldNormal;

void main() {
	worldNormal = normalize( modelViewMatrix * vec4(normal, 0.)).xyz;

	gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
}