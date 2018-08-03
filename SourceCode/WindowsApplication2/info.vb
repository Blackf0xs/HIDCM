Imports System.IO
Imports Newtonsoft.Json.Linq

Public Class info

    Private Sub info_FormClosing(ByVal sender As Object, ByVal e As System.Windows.Forms.FormClosingEventArgs) Handles Me.FormClosing
        Form1.Show()
    End Sub

    Private Sub info_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load

    End Sub

    Private Sub Button2_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button2.Click
        TextBox2.Text = "123456789012"
    End Sub

    Sub GetInformation(ByVal id As String)
        Try
            Dim n As New Net.WebClient
            n.Proxy = Nothing
            Dim s As String = n.DownloadString("http://10.0.45.102/hajj/API/card.php?do=show&cardNum=" & id)
            Dim J As JObject = JObject.Parse(s)
            PictureBox1.Image = Nothing
            If J.SelectToken("status").ToString = 200 Then
                Label2.Text = "Name : " & J.SelectToken("0").SelectToken("full_name").ToString
                Label3.Text = "BD : " & J.SelectToken("0").SelectToken("birthday").ToString
                Label4.Text = "Blood : " & J.SelectToken("0").SelectToken("blood_type").ToString
                Label5.Text = "ID : " & J.SelectToken("0").SelectToken("passport_num").ToString
                Label6.Text = "Country : " & J.SelectToken("0").SelectToken("nationality").ToString
                Label7.Text = "Status : " & J.SelectToken("0").SelectToken("cardStatus").ToString
                Label8.Text = "Balance : " & J.SelectToken("0").SelectToken("balance").ToString
                PictureBox1.Image = Base64ToImage(J.SelectToken("0").SelectToken("picture").ToString)
            Else
                MessageBox.Show(J.SelectToken("message").ToString, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
            End If
        Catch ex As Exception
        End Try
    End Sub

    Public Shared Function Base64ToImage(ByVal base64String As String) As Image
        Dim intMod4 As Integer = base64String.Length Mod 4
        If intMod4 > 0 Then base64String &= "==".Substring(0, 4 - intMod4)
        Dim imageBytes As Byte() = Convert.FromBase64String(base64String)
        Dim ms As New MemoryStream(imageBytes, 0, imageBytes.Length)
        ms.Write(imageBytes, 0, imageBytes.Length)
        Dim image__1 As Image = Image.FromStream(ms, True)
        Return image__1
    End Function



    Private Sub Button4_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button4.Click
        GetInformation(TextBox1.Text)
    End Sub
End Class