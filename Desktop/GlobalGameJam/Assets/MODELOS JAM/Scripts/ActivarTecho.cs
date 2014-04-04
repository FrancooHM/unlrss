using UnityEngine;
using System.Collections;
using UnityEngine;
using System.Collections;

public class ActivarTecho : MonoBehaviour {
	public bool Activar=false;
	public bool comienza=false;
	public bool Activado=false;
	public float delay=0.0f;
	float aux=0.0f;
	public GameObject MiMuerte;
	// Use this for initialization
	void Start () {
		
	}

	[RPC]
	void setearComienza(){
		comienza = true;
	}

	void Update () {
		if (Input.GetKeyDown (KeyCode.E) && Activar)
			networkView.RPC ("setearComienza", RPCMode.All);

		if(comienza)
		aux+=Time.deltaTime;

		if(this.aux>=delay){
			Activado=true;
			
			this.gameObject.rigidbody.useGravity=true;
			rigidbody.AddForce(0, -2500, 0);
			
			
			if(GameObject.Find("Muerte")){
				MiMuerte=GameObject.Find("Muerte");
				MiMuerte.gameObject.layer=13;
			}
			aux=0;
			comienza=false;
			Activar=false;
		}
	}
}
