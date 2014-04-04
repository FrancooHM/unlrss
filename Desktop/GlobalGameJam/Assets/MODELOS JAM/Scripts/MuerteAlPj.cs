using UnityEngine;
using System.Collections;

public class MuerteAlPj : MonoBehaviour {
	
	// Use this for initialization
	void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {

	}
	
	void OnTriggerEnter(Collider other){


		if(other.gameObject.layer==11){

			print("asdeasde");
			if(other.gameObject.name=="Bone"){
				if( other.gameObject.transform.parent.gameObject.transform.parent.GetComponent<ActivarPared>().reproduciendo)
					print("GAME OVER: Bone");
			}

			if(other.gameObject.name=="Gas"){
				if(other.GetComponent<ActivarGas>().Activado)
					print("GAME OVER: Gas");
			}

			if(other.gameObject.name=="electricidad"){
				if(other.gameObject.GetComponent<ActivarElect>().Activado)
					print("GAME OVER: electricidad");
			}

			if(other.gameObject.name=="techo"){
				if( other.gameObject.GetComponent<ActivarTecho>().Activado)
					print("GAME OVER: techo");
			}
		}
	}
}
