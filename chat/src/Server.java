import java.io.IOException;
import java.net.Socket;
import java.util.ArrayList;
import java.net.ServerSocket;

public class Server {
    private static ServerSocket serverSocket = null;
    private static boolean live = true;
    private static Socket clientSocket = null;
    private static ArrayList<NewConnection> clientslist = new ArrayList<NewConnection>();

    public static void main(String[] args) {
        int port = 2115;

        try{
            serverSocket = new ServerSocket(port);
        } catch (IOException e){
            System.err.println("Błąd w tworzeniu Server Socket.");
        }
        System.out.println("Uruchomiono serwer na porcie: " + port);
        while (true){
            try{
                clientSocket = serverSocket.accept();
                NewConnection newConnection = new NewConnection(clientSocket, clientslist);
                clientslist.add(newConnection);
                newConnection.start();
            } catch (IOException e) {
                System.err.println("Błąd w łączeniu użytkownika z serwerem.");
            }
        }
}}

