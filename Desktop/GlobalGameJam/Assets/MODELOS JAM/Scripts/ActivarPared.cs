using UnityEngine;
using System.Collections;

public class ActivarPared : MonoBehaviour {
	public GameObject MiMuerte;
	public bool Activar=false;
	public bool comienza=false;
	public float delay=0.0f;
	public bool reproduciendo = false;
	float aux=0.0f;
	// Use this for initialization
	void Start () {
	
	}
	
	// Update is called once per frame
	void Update () {
		if(Input.GetKeyDown(KeyCode.E)&&Activar)
			comienza=true;

		if(comienza)
			aux+=Time.deltaTime;




		if(this.aux>=delay && reproduciendo==false){
			reproduciendo=true;
			this.gameObject.animation.Play("Caer");

			if(GameObject.Find("Muerte")){
			MiMuerte=GameObject.Find("Muerte");
			MiMuerte.gameObject.layer=13;
			}
		

	
	}
}
}
