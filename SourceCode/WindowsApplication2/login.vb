Imports System.Text.RegularExpressions
Imports Newtonsoft.Json.Linq

Public Class login

    Private Sub login_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Control.CheckForIllegalCrossThreadCalls = False
    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        checkLogin(TextBox1.Text & ":" & TextBox2.Text)
    End Sub

    Sub checkLogin(ByVal Information As String)
        Try
            Dim Info As String() = Information.Split(":")
            Dim user As String = Info(0)
            Dim Pass As String = Info(1)
            Dim n As New Net.WebClient
            n.Proxy = Nothing
            Dim URL As String = String.Format("http://10.0.45.102/hajj/API/login.php?username={0}&password={1}", user, Pass)
            Dim SC As String = n.DownloadString(URL)
            Dim J As JObject = JObject.Parse(SC)
            If J.SelectToken("status").ToString = 200 Then
                Form1.Token = J.SelectToken("token").ToString
                Form1.Show()
                Me.Hide()
            Else
                MessageBox.Show(J.SelectToken("message").ToString, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
            End If
        Catch ex As Exception
            MessageBox.Show("Error!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
        End Try
    End Sub

End Class