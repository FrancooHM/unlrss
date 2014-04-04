using UnityEngine;
using System.Collections;

public class TriggerTrampas : MonoBehaviour {
	public float delaylayer=0.0f;
	float aux=0.0f;
	// Use this for initialization
	void Start () {

	}
	
	// Update is called once per frame
	void Update () {
		if(this.gameObject.layer!=8){
			aux+=Time.deltaTime;
			print(aux);
			if(aux>=delaylayer){
				print("cambio");
				this.gameObject.layer=8;
				aux=0;
			}
		}
	}


	void OnTriggerEnter(Collider other){

		if(other.gameObject.layer==11){

			if(other.gameObject.name=="Bone"){
				other.gameObject.transform.parent.gameObject.transform.parent.GetComponent<ActivarPared>().Activar=true;
			}
			if(other.gameObject.name=="Gas"){
				other.gameObject.GetComponent<ActivarGas>().Activar=true;
			}
			if(other.gameObject.name=="electricidad"){
				other.gameObject.GetComponent<ActivarElect>().Activar=true;

			}
			if(other.gameObject.name=="techo"){
				other.gameObject.GetComponent<ActivarTecho>().Activar=true;
			}
		

		}
	}

	void OnTriggerExit(Collider other){

		if(other.gameObject.layer==11){

			if(other.gameObject.name=="Bone"){
				other.gameObject.transform.parent.gameObject.transform.parent.GetComponent<ActivarPared>().Activar=false;
			}
			if(other.gameObject.name=="Gas"){
				other.gameObject.GetComponent<ActivarGas>().Activar=false;
			}
			if(other.gameObject.name=="electricidad"){
				other.gameObject.GetComponent<ActivarElect>().Activar=false;
				
			}
			if(other.gameObject.name=="techo"){
				other.gameObject.GetComponent<ActivarTecho>().Activar=false;
			}
			
			
		}

	}
}
