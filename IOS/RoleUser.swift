struct RoleUser: Codable {

    var user_id: Int
    var role_id: Int

    var users: [User]
    var roles: [Role]
}
