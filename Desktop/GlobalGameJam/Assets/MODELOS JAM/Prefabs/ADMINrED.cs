using UnityEngine;
using System.Collections;

public class ADMINrED : MonoBehaviour {
	public string NOMBJUEGO;
	public string NOMBTIPOJUEGO;

	public GameObject VidaPrefab;
	public GameObject VidaInitialPos;
	public GameObject JugadorPrefab;
	public GameObject JugadorInitialPos;
	public GameObject MuertePrefab;
	public GameObject MuerteInitialPos;

	public GameObject InstantiatedPlayer = null;

	void Awake(){
		MasterServer.RequestHostList(NOMBTIPOJUEGO);

	}

	void _crearServidor(){
		Network.InitializeServer(2,25000,!Network.HavePublicAddress());
		MasterServer.RegisterHost(NOMBTIPOJUEGO,NOMBJUEGO);
	}

	void _crearJugador(){

		InstantiatedPlayer= (GameObject)Network.Instantiate((GameObject)JugadorPrefab,JugadorInitialPos.transform.position,Quaternion.identity,0);
		InstantiatedPlayer.GetComponentInChildren<Camera>().enabled=true;


	}

	[RPC]
	void _crearVida(){
		if (InstantiatedPlayer == null) {
						InstantiatedPlayer = (GameObject)Network.Instantiate ((GameObject)VidaPrefab, VidaInitialPos.transform.position, Quaternion.identity, 0);
						InstantiatedPlayer.GetComponentInChildren<Camera> ().enabled = true;
				}
	}

	[RPC]
	void _crearMuerte(){
		if (InstantiatedPlayer == null) {
						InstantiatedPlayer = (GameObject)Network.Instantiate ((GameObject)MuertePrefab, MuerteInitialPos.transform.position, Quaternion.identity, 0);
						InstantiatedPlayer.GetComponentInChildren<Camera> ().enabled = true;
				}
	}


	void OnMasterServerEvent(MasterServerEvent other){

		if(other==MasterServerEvent.HostListReceived){
			HostData[] data = MasterServer.PollHostList();
			if(data.Length==0){
				_crearServidor();
			}else{
				NetworkConnectionError error= Network.Connect(data[0]);
				Debug.Log(error.ToString());
			}
		}
	}

	void OnServerInitialized(){
		_crearJugador();

	}

	void OnPlayerConnected(){
		if (GameObject.FindGameObjectsWithTag ("vida").Length == 0)
						networkView.RPC ("_crearVida", RPCMode.Others);
				else
						networkView.RPC ("_crearMuerte", RPCMode.Others);

	}
	// Use this for initialization
	void Start () {

	
	}
	
	// Update is called once per frame
	void Update () {
	
	}
}
