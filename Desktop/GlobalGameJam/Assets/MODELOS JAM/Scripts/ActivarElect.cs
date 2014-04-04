using UnityEngine;
using System.Collections;

public class ActivarElect : MonoBehaviour {
	
	public bool Activar=false;
	public bool Activado=false;
	public float delay=0.0f;
	public float aux=0.0f;
	public bool comienza = false;
	
	// Use this for initialization
	void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
		if (Input.GetKeyDown (KeyCode.E) && Activar)
			comienza = true;
		
		if (comienza)
			aux += Time.deltaTime;
		
		if (this.aux >= delay) {
			Activado = true;
		}
	}
}