using UnityEngine;
using System.Collections;

public class JuntarObjetos : MonoBehaviour {

	// Use this for initialization
	void Start () {
	
	}
	
	// Update is called once per frame
	void Update () {
	
	}
	void OnTriggerEnter(Collider other){
		if(other.gameObject.layer==14){
			Destroy(other.gameObject);

		}
	}
}
