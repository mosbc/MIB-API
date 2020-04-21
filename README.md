# MIB Miner List   

You can download the entire list of registered miners. You can check the availability, the current hash, and the connected pool of each miner device.   

### LIST Request
* Check the device list. Considered suspended if there is no value from hash_rate   
*	If certain miner is requested to stop during Action, the hash_rate immediately becomes empty and the device is automatically stopped   
*	Miner app automatically starts mining on launch, without needing to click start button   
*	Miner monitoring app is distributed with Miner app   
*	Mining app is distributed with monitoring app, and is only available from the device that has installed mining app   
*	Must confirm the pincode creation stage to create Pincode. Contact support@mibcoin.io if help is needed   
*	The interval for Communication is one minute at most   
*	The device is considered stopped(suspended) if no hash_rate is detected for 5 minutes or more.   


##### A) Request device status   
*https://mib-api.mibcoin.io/global/monitor-api/minerlist?id=[MinerID]&offset=[Offset]&limit=[Limit]&type=[live_list]or[stop_list]*   
* **MinerID** : The mining ID of the miner   
* **Offset** : The beginning point of the list
* **Limit** : The number of item to be returned
* **Type** : live_list or stop_list   
  * live_list  : Only see the list of devices that are turned on   
  * stop_list : Only see the list of devices that are stopped   



##### B) Result   
```{idx=49,id="test_miner_id",work_name="test_Worker48",hash_rate="75.85",pool_name="K01-MIB",lastupdate="2020-02-18 13:42:07"}```

* **Receive**   
  * idx : Device number,   
  * id : Registered Miner ID,   
  * work_name : Worker Name for the device,   
  * hash_rate : Hash status ,   
  * pool_name : Currently connected pool,   
  * lastupdate : Last updated time   

  B-1) A device with no hash_rate indicates that it has stopped working.   
  B-2) The device has not been registered successfully if it is not on the list.   
  B-3) Hash_rate will be reset by the API if the device is not responding for 5 or more minutes.   
   
   
---   

  
# Miner Start & Stop   

You can request a particular device to start or stop its mining.   

*https://mib-api.mibcoin.io/global/monitor-api/mineraction?id=[ID]&work_name=[Workername]&action=[start or stop]&pincode=[Pincode]*   

* **[ID]** : Registered Miner ID   
* **[Worker name]** : Worker name given for the device   
* **[Action]** : either start or stop   
* **[Pincode]** : pincode is an additional password for your Miner ID registration   

*	Result : {msg="success"} : Success   

### PINCODE

##### 1. If connected in Miner->AP->internet order, connect using the mobile phone of the ap owner.   
##### 2. Open chrome browser and type mib-api.mibcoin.io/pincode_verify   
##### 3. If the IP is correct IP of the connected miner, enter the ID and PINCODE. You can Start or Stop all the workers with the ID by using the PINCODE.   
    You need to connect at least one worker to start the process.   
    Start the worker, and its IP will be registered on the server.   
    Follow the 1,2,3 steps of pincode and you will be able to register the pincode.   

  * You can create several id=pincode for a single ip. 
  * The registered id will not be dependent on the ip. 
  * ip = id matching is confirmed only once at the initial stage. 
  * Connect and enter to change and the change will be applied immediately.



Too many request to the API might lead to additional cost.   
Limited to three per second.   

   
---   
   
   
# Instruction for Controller Monitoring Application   

The MIB Miner Controller Monitoring Application allows you to monitor the status of miners and work on them.   

<img width="200" src="https://user-images.githubusercontent.com/36949510/78319841-03acd980-75a3-11ea-9a54-858b1b3e39ff.png"></img><br/>

#### 1. Download and install MIB_Monitoring.apk   

#### 2. Run the application and follow the steps:   
* Enter your Miner ID   
* Enter the Pincode for the Miner ID   
* Click the add button   

#### 3. Monitoring and controlling the status of miners   
*The controlling process usually takes about 1-2 minutes*   
* You can control each added miners by their ID   
* There are 'start mining' and 'exit' commands for all connected miners   
* You can also use the above commands for every single miners   
* Indicates 'count' for each working process   

