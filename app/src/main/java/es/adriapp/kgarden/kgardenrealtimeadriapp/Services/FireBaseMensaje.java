package es.adriapp.kgarden.kgardenrealtimeadriapp.Services;

import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.media.RingtoneManager;
import android.net.Uri;
import android.support.v4.app.NotificationCompat.Builder;
import android.support.v4.content.LocalBroadcastManager;

import com.google.firebase.messaging.FirebaseMessagingService;
import com.google.firebase.messaging.RemoteMessage;

import java.util.Random;

import es.adriapp.kgarden.kgardenrealtimeadriapp.MessagesActivity;
import es.adriapp.kgarden.kgardenrealtimeadriapp.R;

/**
 * Created by Usuario on 12/06/2017.
 */

public class FireBaseMensaje extends FirebaseMessagingService {
    @Override
    public void onMessageReceived(RemoteMessage remoteMessage) {

        super.onMessageReceived(remoteMessage);
        String mensaje = remoteMessage.getData().get("mensaje");
        String hora = remoteMessage.getData().get("hora");
        String cabecera = remoteMessage.getData().get("hora");

        Message(mensaje, hora);
        ShowNotification(cabecera, mensaje, hora);
    }
    private void Message(String mensaje, String hora){

        Intent i = new Intent(MessagesActivity.MESSAGE);
        i.putExtra("mensaje_key", mensaje);
        i.putExtra("hora_key", hora);
        LocalBroadcastManager.getInstance(getApplicationContext()).sendBroadcast(i);
    }


    //Para que funcione la notificadasdasdasción dentro de la aplicación
    private void ShowNotification(String cabecera, String mensaje, String hora){
        Intent i = new Intent(this, MessagesActivity.class);

        PendingIntent pendingIntent = PendingIntent.getActivity(this, 0, i, PendingIntent.FLAG_ONE_SHOT);

        Uri uri = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);

        Builder builder = new Builder(this);
        builder.setAutoCancel(true);
        builder.setContentTitle(cabecera);
        builder.setContentText(mensaje + hora.substring(11,13));
        builder.setSound(uri);
        builder.setSmallIcon(R.drawable.ic_launcher);
        builder.setContentIntent(pendingIntent);
        NotificationManager notificationManager = (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);

        Random random = new Random();

        //Para que no sobreescriba la antigua notificación le meto un random
        notificationManager.notify(random.nextInt(),builder.build());
    }
}
