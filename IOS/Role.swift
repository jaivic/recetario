struct Role: Codable {

    var id: Int
    var name: String
    var display_name: String?
    var description: String?
    var created_at: String?
    var updated_at: String?

    var users: [User]
}
