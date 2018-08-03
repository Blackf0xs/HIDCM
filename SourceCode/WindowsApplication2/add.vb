
Imports Newtonsoft.Json.Linq
Imports System.IO

Public Class add


    Private Sub add_FormClosing(ByVal sender As Object, ByVal e As System.Windows.Forms.FormClosingEventArgs) Handles Me.FormClosing
        Form1.Show()
    End Sub

    Private Sub add_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load

    End Sub

    Private Sub Label7_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Label7.Click

    End Sub

    Private Sub Button4_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button4.Click
        TextBox1.Text = "123456789012"
    End Sub

    Private Sub Button2_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button2.Click

    End Sub

    Private Sub Button3_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button3.Click

    End Sub


    Sub GetInformation(ByVal id As String)
        Try
            Dim n As New Net.WebClient
            n.Proxy = Nothing
            Dim s As String = n.DownloadString("?id=" & id)
            Dim J As JObject = JObject.Parse(s)
            Label2.Text = "Name :" & J.SelectToken("name").ToString
            Label3.Text = "Age :" & J.SelectToken("name").ToString
            Label4.Text = "Phone :" & J.SelectToken("name").ToString
            Label5.Text = "ID :" & TextBox2.Text
            Label6.Text = "Country :" & J.SelectToken("name").ToString
            Label7.Text = "Status :" & J.SelectToken("name").ToString
            PictureBox1.Image = convertbytetoimage(ConvertBase64ToByteArray(J.SelectToken("photo").ToString))
        Catch ex As Exception
            MessageBox.Show("Error!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
        End Try
    End Sub

    Public Function ConvertBase64ToByteArray(ByVal base64 As String) As Byte()
        Return Convert.FromBase64String(base64)
    End Function

    Private Function convertbytetoimage(ByVal BA As Byte())
        Dim ms As MemoryStream = New MemoryStream(BA)
        Dim image = System.Drawing.Image.FromStream(ms)
        Return image
    End Function

End Class