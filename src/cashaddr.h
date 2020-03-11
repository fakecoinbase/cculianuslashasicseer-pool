/* Cash Address decode for ckpool.
 * Code adapted to C from C++ by Calin Culianu <calin.culianu@gmail.com>
 * LICENSE: MIT
 * Original C++ sources: Bitcoin Cash Node https://gitlab.com/bitcoin-cash-node/bitcoin-cash-node
 */
#ifndef CASHADDR_H
#define CASHADDR_H

#include <stdint.h>

/* Returns a 20-byte buffer containing the hash160 of the pk or script decoded
 * from a cashaddr string, or NULL on bad address string. The passed-in string
 * may be preceded by a prefix such as "bitcoincash:", "bchtest:", or "bchreg:".
 * If no prefix is specified, 'default_prefix' is assumed. If default_prefix is
 * null or empty, "bitcoincash" is assumed. Make sure default_prefix has no
 * trailing ':'. Use the correct default_prefix to ensure proper checksum
 * validation.
 *
 * The returned buffer must be freed by the caller.
 */
extern uint8_t *cashaddr_decode_hash160(const char *addr,
                                        const char *default_prefix /* <- may be null or empty, in which case
                                                                         "bitcoincash" is used */);
#define CASHADDR_HEURISTIC_LEN 35

// NB: if these ever change, please make sure they are <16 bytes or if not, modify
// the buffer in struct ckpool_instance "cashaddr_prefix" to accomodate the larger length
#define CASHADDR_PREFIX_MAIN "bitcoincash"
#define CASHADDR_PREFIX_TEST "bchtest"
#define CASHADDR_PREFIX_REGTEST "bchreg"

#endif