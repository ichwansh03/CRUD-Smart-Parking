package com.example.introduction

import android.content.Context
import android.os.Bundle
import android.util.Log
import android.widget.Toast
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
import androidx.compose.material.MaterialTheme
import androidx.compose.material.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.mutableStateListOf
import androidx.compose.runtime.remember
import androidx.compose.ui.platform.LocalContext
import androidx.compose.ui.tooling.preview.Preview
import com.android.volley.Request
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.Volley

class MainActivity : ComponentActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            val parkingList = remember { mutableStateListOf<ParkingData>() }

            MaterialTheme {
                loadDataFromApi(this, parkingList)
                DisplayParkingList(parkingList)
            }
        }
    }
}

data class ParkingData(val id: Int, val name: String, val capacity: Int, val volume: Int)

@Composable
fun loadDataFromApi(context : Context, parkingList: MutableList<ParkingData>) {
    val requestQueue = Volley.newRequestQueue(LocalContext.current)
    val jsonArrayRequest = JsonArrayRequest(
        //ubah URL pada bagian ini [ip address yang terhubung ke laptop atau pc/nama folder/nama file untuk get data]
        Request.Method.GET, "http://192.168.43.8/smart_parking/ict.php", null,
        { response ->
            for (i in 0 until response.length()) {
                val parkingObject = response.getJSONObject(i)
                //nama-nama field yang diambil dari tbl_ict
                val id = parkingObject.getInt("id")
                val name = parkingObject.getString("name")
                val capacity = parkingObject.getInt("capacity")
                val volume = parkingObject.getInt("volume")
                val parkingData = ParkingData(id, name, capacity, volume)
                parkingList.add(parkingData)
            }
        },
        { error ->
            Toast.makeText(context, "Error: ${error.message}", Toast.LENGTH_SHORT).show()
            error.printStackTrace()
        }
    )

    requestQueue.add(jsonArrayRequest)
}

@Composable
fun DisplayParkingList(parkingList: List<ParkingData>) {
    LazyColumn {
        items(parkingList) { parkingData ->
            Text(
                text = "Name: ${parkingData.name}, Volume: ${parkingData.volume}, Capacity: ${parkingData.capacity}"
            )
        }
    }
}

@Preview
@Composable
fun DefaultPreview() {
    val parkingList = listOf(
        ParkingData(1, "Parking 1", 50, 30),
        ParkingData(2, "Parking 2", 100, 80),
        ParkingData(3, "Parking 3", 80, 50)
    )

    DisplayParkingList(parkingList)
}
