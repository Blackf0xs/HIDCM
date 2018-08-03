Imports Newtonsoft.Json.Linq

Public Class cancel

    Private Sub cancel_FormClosing(ByVal sender As Object, ByVal e As System.Windows.Forms.FormClosingEventArgs) Handles Me.FormClosing
        Form1.Show()
    End Sub

    Private Sub cancel_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load

    End Sub

    Private Sub Button4_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button4.Click
        GetInformation(TextBox1.Text, TextBox2.Text)
    End Sub

    Sub GetInformation(ByVal id As String, ByVal pid As String)
        Try
            Dim n As New Net.WebClient
            n.Proxy = Nothing
            Dim s As String = n.DownloadString("http://10.0.45.102/hajj/API/card.php?do=cancel&cardNum=" & id & "&pid=" & pid)
            Dim J As JObject = JObject.Parse(s)
            If J.SelectToken("status").ToString = 200 Then
                MessageBox.Show(J.SelectToken("message").ToString, "Okay", MessageBoxButtons.OK, MessageBoxIcon.Information)
            Else
                MessageBox.Show(J.SelectToken("message").ToString, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
            End If
        Catch ex As Exception
        End Try
    End Sub

End Class