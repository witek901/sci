import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.net.Socket;
import java.util.ArrayList;


public class NewConnection extends Thread{
    Socket clientSocket;
    ObjectInputStream in = null;
    ObjectOutputStream out = null;
    private final ArrayList<NewConnection> clientslist;
    String nick;

    public NewConnection(Socket clientSocket, ArrayList<NewConnection> clientslist) {
        this.clientSocket = clientSocket;
        this.clientslist = clientslist;
    }

    @Override
    public void run(){
        ArrayList<NewConnection> clientslist = this.clientslist;

        try {
            in = new ObjectInputStream(clientSocket.getInputStream());
            out = new ObjectOutputStream(clientSocket.getOutputStream());
            nick = (String) in.readObject();
            System.out.println(nick + " dołączył do chatu.");
            for (NewConnection conn : clientslist) {
                if (conn != null) {
                    conn.out.writeObject(nick + " dołączył do chatu.");
                    conn.out.flush();
                }
            }
        } catch (IOException | ClassNotFoundException e) {
            System.out.println("Błąd podczas tworzenia in/out.1"); //zmienic na logging
        }
        System.out.println("clienctSocket="+clientSocket.toString());

        try {
            while (true){
                String line = (String) in.readObject();

                for (NewConnection client : clientslist) {
                    if (client != null && client.nick != this.nick) {
                        client.out.writeObject("<" + nick + "> " + line);
                        client.out.flush();
                    }
                }
            }
        } catch (IOException | ClassNotFoundException ioException) {
            ioException.printStackTrace();
        }

        try {
            for (NewConnection client : clientslist) {
                if (client != null && client.nick != this.nick) {
                    client.out.writeObject("\n" + nick + " opuścił chat.");
                    client.out.flush();
                }
            }
            System.out.println(nick + " opuścił chat.");
        } catch (IOException e) {
            e.printStackTrace();
        }
        clientslist.remove(this);
        try {
            this.in.close();
            this.out.close();
            clientSocket.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}

