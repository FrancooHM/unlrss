using UnityEngine;
using System.Collections;

public class Encendedor : MonoBehaviour {
	public bool Activado = false;
	// Use this for initialization
	void Start () {
		
	}
	[RPC]
	void encenderLuz(){
		
		for (int i = 0; i<this.gameObject.transform.childCount ; i++){
			
			if ("Light" == this.gameObject.transform.GetChild(i).name){
				GameObject Luz = this.gameObject.transform.GetChild(i).gameObject;
				Luz.SetActive(!Luz.activeInHierarchy);
				Activado=!Activado;
			}
			
		}
		
	}
	//Muerte 8
	//Vida 9
	//Personaje 12

	// Update is called once per frame
	void Update () {
		if (!networkView.isMine)
						return;

		if (Input.GetKeyDown (KeyCode.F))
								networkView.RPC ("encenderLuz", RPCMode.All);
				}
}
