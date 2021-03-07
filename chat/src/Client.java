import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.io.IOException;
import java.net.Socket;
import java.net.UnknownHostException;

public class Client implements Runnable {

    private static Socket clientSocket = null;
    private static ObjectOutputStream out = null;
    private static ObjectInputStream in = null;
    private static BufferedReader brl = null;
    private static Boolean closed = false;

    public static void main(String[] args) throws IOException {
        int port = 2115;
        String host = "127.0.0.1";

        try {
            clientSocket = new Socket(host, port);
            brl = new BufferedReader(new InputStreamReader(System.in));
            out = new ObjectOutputStream(clientSocket.getOutputStream());
            in = new ObjectInputStream(clientSocket.getInputStream());
            System.out.println("Podaj nazwę użytkownika: ");
        } catch (UnknownHostException e) {
            System.err.println("Nieznany " + host);
        } catch (IOException e) {
            System.err.println("Błąd, serwer nie został znaleziony.");
        }

        if (clientSocket != null && out != null && in != null) {
            try {
                new Thread(new Client()).start();
                while (!closed) {
                    String msg = brl.readLine();
                    out.writeObject(msg);
                    out.flush();
                }
                out.close();
                in.close();
                clientSocket.close();
            } catch (IOException e)
            {
                System.err.println("Wyjątek: " + e);
            }
        }
        clientSocket.close();
    }

    public void run() {
        String line;

        try {
            while ((line = (String) in.readObject()) != null)  {
                System.out.println(line);
            }
            System.exit(0);
        } catch (IOException | ClassNotFoundException e) {
            System.err.println("Zatrzymanie serwera, exception.");
        }
    }
}