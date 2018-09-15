struct PermissionRole: Codable {

    var permission_id: Int
    var role_id: Int

    var permissions: [Permission]
    var roles: [Role]
}
